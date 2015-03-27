@if (count($errors->all()) > 0)
<section class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-danger alert-block">
                <i class="fa fa-frown-o"></i>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Erreur</strong>
                <ul class="list-icon times">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                <ul>
            </div>
        </div>
    </div>
</section>
@endif

@if ($message = Session::get('success'))
<section class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-success alert-block">
                <i class="fa fa-check-circle"></i>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Succès</strong>
                @if(is_array($message))
                @foreach ($message as $m)
                {{ $m }}
                @endforeach
                @else
                {{ $message }}
                @endif
            </div>
        </div>
    </div>
</section>
@endif

@if ($message = Session::get('error'))
<section class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-danger alert-block">
                <i class="fa fa-frown-o"></i>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Erreur</strong>
                @if(is_array($message))
                @foreach ($message as $m)
                {{ $m }}
                @endforeach
                @else
                {{ $message }}
                @endif
            </div>
        </div>
    </div>
</section>
@endif

@if ($message = Session::get('warning'))
<section class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-warning alert-block">
                <i class="fa fa-warning"></i>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Attention</strong>
                @if(is_array($message))
                @foreach ($message as $m)
                {{ $m }}
                @endforeach
                @else
                {{ $message }}
                @endif
            </div>
        </div>
    </div>
</section>
@endif

@if ($message = Session::get('info'))
<section class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-info alert-block">
                <i class="fa fa-info-circle"></i>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Information</strong>
                @if(is_array($message))
                @foreach ($message as $m)
                {{ $m }}
                @endforeach
                @else
                {{ $message }}
                @endif
            </div>
        </div>
    </div>
</section>
@endif
