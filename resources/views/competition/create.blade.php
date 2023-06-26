<x-html :title="'Competitie aanmaken'">
    <head>
        <title>Competitie aanmaken</title>
    </head>
    <div class="d-flex justify-content-center">
        <div class="card mx-auto">
            <div class="card-header">
                <h1>Competitie aanmaken</h1>
            </div>
            <div class="card-body">
                <form method="post" action="{{route('competition.store')}}" class="needs-validation" novalidate>
                    <div class="form-group">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="title">Titel <span class="text-danger">*</span></label>
                            <input maxlength="45" type="text" name="title" id="title" value="{{ old('title') }}"
                                   class="form-control">
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
                            <textarea maxlength="200" name="description" id="description" class="form-control">{{ old('description') }}</textarea>
                            <div>
                                <small><span id="description-counter">{{ 200 - strlen(old('description')) }}</span> karakters resterend</small>
                            </div>
                            @foreach($errors->get('description') as $message)
                                <div class="text-danger">
                                    {{$message}}
                                </div>
                            @endforeach
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="start_date">Startdatum <span
                                    class="text-danger">*</span></label>
                            <input type="date" id="start_date" name="start_date" class="form-control"
                                   value="{{ old('start_date') }}">
                            @foreach($errors->get('start_date') as $message)
                                <div class="text-danger">
                                    {{$message}}
                                </div>
                            @endforeach
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="date">Einddatum</label>
                            <input type="date" id="date" name="end_date" class="form-control"
                                   value="{{ old('end_date') }}">
                            @foreach($errors->get('end_date') as $message)
                                <div class="text-danger">
                                    {{$message}}
                                </div>
                            @endforeach
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="thumbnail_url">Thumbnail</label>
                            <input type="url" name="thumbnail_url" id="thumbnail_url" class="form-control"
                                   value="{{ old('thumbnail_url') }}">
                            @foreach($errors->get('thumbnail_url') as $message)
                                <div class="text-danger">
                                    {{$message}}
                                </div>
                            @endforeach
                            <p class="text-muted">Vul hierboven de URL in van een afbeelding die je wilt gebruiken als
                                thumbnail van de competitie.</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="submissions_limit">Inzendingen per gebruiker <span
                                    class="text-danger">*</span></label>
                            <select class="form-select mr-sm-2" id="submissions_limit" name="submissions_limit">
                                @for($i = 1; $i < 6; $i++)
                                    <option value="{{$i}}">{{$i}}</option>
                                @endfor
                            </select>
                            @foreach($errors->get('submissions_limit') as $message)
                                <div class="text-danger">
                                    {{$message}}
                                </div>
                            @endforeach
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="publication_status">Welke publicatiestatus wil je toekennen
                                aan de competitie? <span class="text-danger">*</span></label>
                            <select name="publication_status" class="form-select" aria-label="publication_status">
                                @foreach($possiblePublicationStatuses as $status)
                                    <option value="{{$status}}">{{$status}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="private">Zichtbaarheid <span
                                    class="text-danger">*</span></label>
                            <select name="private" class="form-select">
                                <option value="public">Publiek</option>
                                <option value="private">Privé</option>
                            </select>
                        </div>
                        <p id="submission-method-error" class="text-danger">* Verplichte velden</p>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Aanmaken</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-html>
