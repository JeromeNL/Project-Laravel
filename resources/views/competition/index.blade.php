<x-html :title="'Competitie overzicht'">
    <head>
        <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    </head>
    <div class="my-3">
        @if (flash()->message)
            <div class="alert alert-success">
                {{ flash()->message }}
            </div>
        @endif
        <h1>Alle competities</h1>
        <div class="row">
            @foreach($competitions as $competition)
                <div class="col-12 col-md-6 col-xl-4 mb-3">
                    <x-competition-card indexType="regular" :competition="$competition" :joined="$joined"/>
                </div>
            @endforeach
        </div>
    </div>
</x-html>
