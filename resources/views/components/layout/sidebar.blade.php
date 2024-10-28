<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('AdminLTE/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('AdminLTE/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Alexander Pierce</a>
            </div>
        </div>
        <div class="file-system">
            <div class="files-buttons mb-2 w-100 d-flex justify-content-end" style="column-gap: 0.5rem">
                <a href="#" class="button">
                    <i class="fas fa-plus"></i>
                    <i class="far fa-file"></i>
                </a>
                <a href="#" class="button">
                    <i class="fas fa-plus"></i>
                    <i class="far fa-folder"></i>
                </a>
            </div>
            <x-file-system.file-system />
        </div>
    </div>
</aside>
