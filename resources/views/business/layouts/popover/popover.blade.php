<div class="x_content bs-example-popovers">
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade in" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
            </button>
            <strong>Success!</strong> {{ session('success') }}
        </div>
    @endif

    @if (session('info'))
        <div class="alert alert-info alert-dismissible fade in" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
            </button>
            <strong>Info!</strong> {{ session('info') }}
        </div>
    @endif

    @if (session('warning'))
        <div class="alert alert-warning alert-dismissible fade in" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
            </button>
            <strong>Warning!</strong> {{ session('warning') }}
        </div>
    @endif

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <strong>Danger!</strong> {{ session('danger') }}
            </div>
        @endforeach
    @endif

</div>