import './bootstrap';
import { InitilizeEditor } from "./code-editor";
import { InitilizeChat } from './chat';

$(document).ready(async () => {
    InitilizeEditor('documents/index.html')
    InitilizeChat();
});

