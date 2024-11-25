<?php

namespace App\Livewire\Components;

use Livewire\Component;

class Chat extends Component
{
    public $inputValue = '';
    public $inputAttachment = '';
    public $messages = [];
    public $errorMessage = '';

    public function mount() {
        if (isset($_SESSION['messages']))
            $this->messages = $_SESSION['messages'];
    }

    public function render()
    {
        return view('livewire.components.chat');
    }

    public function sendMessage(): void
    {
        $messagesData = $this->messages;
        $messagesData[] = [
            'role' => 'user',
            'content' => $this->getPrompt(),
        ];
        $data = [
            'model' => 'microsoft/Phi-3.5-mini-instruct',
            'messages' => $messagesData,
            'temperature' => 0.0,
            'max_tokens' => 5024,
            'stream' => false,
        ];
        $json = json_encode($data);

        $curl = null;
        $response = null;
        try {
            $curl = curl_init('https://api-inference.huggingface.co/models/microsoft/Phi-3.5-mini-instruct/v1/chat/completions');
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
                'Content-Length: ' . strlen($json),
                'Authorization: Bearer ' . env('API_KEY')
            ]);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $json);

            $response = curl_exec($curl);
            $decodedResponse = json_decode($response, true);
            $messageObject = $decodedResponse['choices'][0]['message'];
            $cleanedCodeResponse = preg_replace('/```[a-z]*\n?|```/', '', $messageObject['content']);

            $this->addMessage('user', $this->inputValue);
            $this->addMessage($messageObject['role'], $cleanedCodeResponse);

            $this->inputAttachment = '';
            $this->errorMessage = '';
        } catch (\Exception $e) {
            $this->errorMessage = "API Error: " . $e->getMessage();
        } finally {
            if ($curl !== null) {
                curl_close($curl);
                if ($response === false) {
                    $this->errorMessage = 'cURL Error: ' . curl_error($curl);
                }
            }
        }
        $_SESSION['messages'] = $this->messages;
    }

    private function addMessage(string $role, string $message): void
    {
        $this->messages[] = [
            'role' => $role,
            'content' => $message
        ];
    }

    private function getPrompt() {
        $basePrompt = "Don't make any comments, markup or explanation about the code and get me just and only the plain text needed for: ";
        if ($this->inputAttachment !== '') {
            return "$basePrompt Considering that $this->inputValue,
                send me the refactored version of the following code
                like you would replace it, remeber to keep the current identation:
                $this->inputAttachment";
        }
        return "$basePrompt $this->inputValue";
    }
}
