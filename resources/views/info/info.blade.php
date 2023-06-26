<x-html : title="Uitleg pagina">
    <head>
        <link rel="stylesheet" href="{{ asset('css/stars.css') }}">
    </head>
    <div>
        <h3>Uitleg pagina</h3>
        <div class="text-muted">
            <p>Welkom bij de uitlegpagina hier worden mogelijke vragen die je hebt als bezoeker beantwoord zodat je
                gebruik kan maken van onze website.</p>
        </div>
    </div>

    <div class="accordion mb-3" id="accordionPanelsStayOpenExample">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#accordion-1"
                        aria-expanded="true" aria-controls="accordion-1">
                    Hoe maak je een competitie aan?
                </button>
            </h2>
            <div id="accordion-1" class="accordion-collapse collapse" aria-labelledby="headingOne">
                <div class="accordion-body">
                    <div class="mb-3">
                        <p>Als je een competitie wil aanmaken navigeer je eerst naar de competitieoverzichtspagina.</p>
                        <p>Nadat je hier naar toe bent genavigeerd kun je de volgende knop zien:</p>
                        <button class="btn btn-primary disabled my-2">Competitie aanmaken</button>
                        <p>Nadat je op deze knop hebt geklikt krijg je het volgende formulier te zien:</p>
                        <div class="card mt-3">
                            <div class="card-body">
                                <form>
                                    <div class="form-group">
                                        <div class="mb-3">
                                            <label class="form-label">Titel</label>
                                            <input type="text" name="title" class="form-control"
                                                   value="{{ old('title') }}"
                                                   readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Beschrijving</label>
                                            <textarea name="description" class="form-control"
                                                      readonly>{{ old('description') }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Startdatum</label>
                                            <input type="date" name="start_date" class="form-control"
                                                   value="{{ old('start_date') }}" readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Einddatum</label>
                                            <input type="date" name="end_date" class="form-control"
                                                   value="{{ old('end_date') }}" readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Thumbnail</label>
                                            <input type="url" name="thumbnail_url" class="form-control"
                                                   value="{{ old('thumbnail_url') }}" readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Inzendingen per gebruiker</label>
                                            <select class="form-select mr-sm-2" id="submissions_limit"
                                                    name="submissions_limit">
                                                @for($i = 0; $i < 5; $i++)
                                                    <option value="{{$i + 1}}">{{$i + 1}}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <div class="form-group col-xs-4 col-md-4">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox"
                                                           id="flexSwitchCheckDefault" name="isConcept"
                                                           value="{{ old('concept_boolean') }}" readonly>
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Als
                                                        concept
                                                        opslaan?</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-grid">
                                            <input class="btn btn-primary disabled" value="Aanmaken">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <p>Hier vul je de gewenste waardes in voor die competitie die jij wilt maken!</p>
                        <p>Als je tevreden bent met de gekozen waardes kan je op de knop klikken.</p>
                        <button class="btn btn-primary disabled m-1">Aanmaken</button>
                        <p>Hierdoor zal de competitie getoond worden bij het competitieoverzicht.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#accordion-2" aria-expanded="false" aria-controls="accordion-2">
                    <p>Hoe neem ik deel aan een competitie?</p>
                </button>
            </h2>
            <div id="accordion-2" class="accordion-collapse collapse" aria-labelledby="headingTwo">
                <div class="accordion-body">
                    <div>
                        <p>Als je mee wil doen aan een competitie moet je er eerst een uitkiezen op de
                            competitieoverzichtspagina.</p>
                        <div class="card">
                            <div class="card-body">
                                <p>Competities kunnen verschillende statussen hebben die zijn als volgt:</p>
                                <button class="btn btn-primary disabled mt-2">Afgelopen</button>
                                <p>Dit betekent dat je helaas de competitie hebt gemist en er niet meer aan kan deelnemen.</p>
                                <button class="btn btn-primary disabled mt-2">Start binnenkort</button>
                                <p>Dit betekent dat de competitie nog moet beginnen op de startdatum kan jij je inschrijven!</p>
                                <button class="btn btn-primary mt-2">Deelnemen</button>
                                <p>Dit betekent dat je kan deelnemen aan deze competitie!</p>
                            </div>
                        </div>
                    </div><p>Nadat je op de "deelnemen" knop hebt geklikt ben je officieel een competitiedeelnemer. Dit betekent
                    dat de competitie in het overzicht van jouw deelgenomen competities getoond zal worden.</p>
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#accordion-3" aria-expanded="false" aria-controls="accordion-3">
                    Hoe kan ik een inzending maken?
                </button>
            </h2>
            <div id="accordion-3" class="accordion-collapse collapse" aria-labelledby="headingThree">
                <div class="accordion-body">
                    <div>Je kan een inzending maken nadat je een lopende competitie hebt toegetreden.</p>
                        <p>Bij het overzicht van de gejoinde competities heb je de keuze uit twee verschillende opties:</p>
                        <div class="card">
                            <div class="card-body">
                                <p>Competities kunnen verschillende statussen hebben die zijn als volgt:</p>
                                <button class="btn btn-primary">Details</button>
                                <p>Deze knop verwijst je naar de details pagina van een competitie hier kan er worden beoordeeld.</p>
                                <button class="btn btn-primary">Insturen</button>
                                <p>Met deze knop kan je een inzending aanmaken.</p>
                            </div>
                        </div>
                        <p>Nadat je op de knop voor het insturen hebt geklikt opent de volgende form die ingevuld kan worden:</p>
                        <div class="card mt-3">
                            <div class="card-body">
                                <form>
                                    <div class="mb-3">
                                        <label class="form-label">Titel</label>
                                        <input type="text" name="title" value="{{old('title')}}" class="form-control"
                                               disabled>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Beschrijving</label>
                                        <textarea name="description" class="form-control"
                                                  disabled>{{old('description')}}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Jouw foto</label>
                                        <input type="url" value="{{old('submission_url')}}" name="submission_url"
                                               class="form-control"
                                               disabled>
                                    </div>
                                    <div class="d-grid">
                                        <input type="submit" class="btn btn-primary" value="Insturen" disabled>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <p>Nadat je alle velden hebt ingevuld kan je op de "insturen" knop klikken:</p>
                        <button class="btn btn-primary disabled m-1">Insturen</button>
                        <p>Hierdoor zal jouw inzending in de lijst van inzendingen komen bij de competitie en kan die
                        beoordeeld worden!</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header" id="headingFour">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#accordion-4"
                        aria-expanded="true" aria-controls="accordion-4">
                    <p>Hoe kan ik inzendingen beoordelen?</p>
                </button>
            </h2>
            <div id="accordion-4" class="accordion-collapse collapse" aria-labelledby="headingFour">
                <div class="accordion-body">
                    <div>
                        <p>Om inzendingen te beoordelen moet je eerst navigeren naar een lopende competitie bij het
                            overzicht van je gejoinde competities.</p>
                        <p>Bij het overzicht van je gejoinde competities klik je op de knop:</p>
                            <button class="btn btn-primary disabled m-1">Beoordelen</button>
                        <p>Hiermee word je verwezen naar de detailpagina van de competitie. Hier zie je extra informatie over de competitie. Verder kan je ook alle inzendingen zien.</p>
                        <p>Naast het zien van de inzendingen kan je ze hier ook beoordelen. Dit doe je door een aantal sterren te selecteren van 1-5.</p>
                        <div class="rating-wrap mb-3">
                            <div class="center">
                                <form>
                                    <div class="rating">
                                        <input type="radio"
                                               id={{"star5-"}} name={{"rating"}} value="5"/>
                                        <label for={{"star5-"}} class="full" title="Awesome"></label>
                                        <input type="radio"
                                               id={{"star4.5-"}} name={{"rating"}} value="4.5"/>
                                        <label for={{"star4.5-"}} class="half"></label>
                                        <input type="radio"
                                               id={{"star4-"}} name={{"rating"}} value="4"/>
                                        <label for={{"star4-"}} class="full"></label>
                                        <input type="radio"
                                               id={{"star3.5-"}} name={{"rating"}} value="3.5"/>
                                        <label for={{"star3.5-"}} class="half"></label>
                                        <input type="radio"
                                               id={{"star3-"}} name={{"rating"}} value="3"/>
                                        <label for={{"star3-"}} class="full"></label>
                                        <input type="radio"
                                               id={{"star2.5-"}} name={{"rating"}} value="2.5"/>
                                        <label for={{"star2.5-"}} class="half"></label>
                                        <input type="radio"
                                               id={{"star2-"}} name={{"rating"}} value="2"/>
                                        <label for={{"star2-"}} class="full"></label>
                                        <input type="radio"
                                               id={{"star1.5-"}} name={{"rating"}} value="1.5"/>
                                        <label for={{"star1.5-"}} class="half"></label>
                                        <input type="radio"
                                               id={{"star1-"}} name={{"rating"}} value="1"/>
                                        <label for={{"star1-"}} class="full"></label>
                                        <input type="radio"
                                               id={{"star0.5-"}} name={{"rating"}} value="0.5"/>
                                        <label for={{"star0.5-"}} class="half"></label>
                                    </div>
                                    <input name="Beoordeel" value="Beoordeel"
                                           class="btn disabled bg-secondary">
                                </form>
                            </div>
                        </div>
                        <p>Nadat je tevreden bent met het cijfer dat je een inzending hebt gegeven kan je klikken op de knop:</p>
                            <button class="btn btn-primary disabled m-1">Beoordeel</button>
                        <p>Hiermee zal je beoordeling opgeslagen worden.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-html>
