<x-html :title="'Inzending aanmaken'">
    <div class="d-flex justify-content-center">
        <div class="card mx-auto">
            <div class="card-header">
                <h1>Inzending insturen voor:</h1>
                <h3>{{$competition->title}}</h3>
                @if($limitReached)
                    <p>Je hebt de limiet van {{$competition->submissions_limit}} inzendingen bereikt en kunt dus niets meer inzenden.</p>
                @else
                    @if($competition->unlimited_submissions_allowed)
                        <p>Je kunt een <b>onbeperkt</b> aantal inzendingen insturen.</p>
                    @else
                        <p>Voor deze competitie kun je maximaal <b>{{$competition->submissions_limit}}</b> inzendingen insturen.</p>
                    @endif
                @endif
            </div>
            <div class="card-body">
                <form method="post" action="{{route('competition.submission.store', ['competition' => $competition])}}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="competition_id" value="{{$competition->id}}">
                    <div class="mb-3">
                        <label class="form-label" for="title">Titel <span class="text-danger">*</span></label>
                        <input maxlength="45" type="text" name="title" id="title" value="{{old('title')}}" class="form-control" {{$limitReached  ? "disabled" : ""}}>
                        <div>
                            <small><span id="title-counter">{{ 45 - strlen(old('title')) }}</span> karakters resterend</small>
                        </div>
                        @foreach($errors->get('title') as $message)
                            <div class="text-danger">
                                {{$message}}
                            </div>
                        @endforeach
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="description">Beschrijving</label>
                        <textarea maxlength="200" name="description" id="description" class="form-control" {{$limitReached  ? "disabled" : ""}}>{{old('description')}}</textarea>
                        <div>
                            <small><span id="description-counter">{{ 200 - strlen(old('description')) }}</span>karakters resterend</small>
                        </div>
                        @foreach($errors->get('description') as $message)
                            <div class="text-danger">
                                {{$message}}
                            </div>
                        @endforeach
                    </div>
                    <h5>Gebruik één van de methoden <span class="text-danger">*</span></h5>
                    <div id="submission-methods" class="mb-3">
                        <div id="submission-file" class="mb-3 bg-light p-3 border border-secondary rounded-3">
                            <label class="form-label" for="submission_image">
                                <span class="fa-stack">
                                    <i class="fas fa-circle fa-stack-2x"></i>
                                    <strong class="fa-stack-1x fa-inverse">1</strong>
                                </span>
                                Jouw foto (bestand)</label>
                            <input type="file" id="submission_image" name="submission_image"
                                   accept=".jpeg, .svg, .png, .pdf, .gif, .jpg" class="form-control">
                            <button type="button" id="clear-file" class="btn btn-outline-secondary mt-2">Clear</button>
                            @foreach($errors->get('submission_image') as $message)
                                <div class="text-danger">
                                    {{$message}}
                                </div>
                            @endforeach
                        </div>
                        <div id="submission-url" class="mb-3 bg-light p-3 border border-secondary rounded">
                            <label class="form-label" for="submission_url">
                                <span class="fa-stack">
                                    <i class="fas fa-circle fa-stack-2x"></i>
                                    <strong class="fa-stack-1x fa-inverse">2</strong>
                                </span>
                                Jouw foto (url)</label>
                            <input type="url" id="submission_url" value="{{old('submission_url')}}"
                                   {{$limitReached ? "disabled" : ""}} name="submission_url" class="form-control">
                            @foreach($errors->get('submission_url') as $message)
                                <div class="text-danger">
                                    {{$message}}
                                </div>
                            @endforeach
                        </div>
                        <p id="submission-method-error" class="text-danger">* Kies ten minste één van de bovenstaande methoden.</p>
                    </div>
                    <div class="d-grid">
                        @if($competition->ended)
                            <a href="#" class="btn btn-info disabled">Afgelopen</a>
                        @else
                            <input type="submit" class="btn btn-primary" value="Insturen" {{$limitReached ? "disabled" : ""}}>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-html>
