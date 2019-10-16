<div class="x_content bs-example-popovers">
    @if (session('success'))
        <div class="alert alert-success alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
            <a class="alert-link" href="#">Success!!!</a> {{ session('success') }}
        </div>
    @endif

    @if (session('info'))
        <div class="alert alert-info alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
            <a class="alert-link" href="#">Notice!!!</a> {{ session('info') }}
        </div>
    @endif

    @if (session('warning'))
        <div class="alert alert-warning alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
            <a class="alert-link" href="#">Warning!!!</a> {{ session('warning') }}
        </div>
    @endif

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                <a class="alert-link" href="#">Danger!!!</a>  {{ session('danger') }}
            </div>
        @endforeach
    @endif

</div>
