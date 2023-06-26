@if (Auth::check() && Auth::user()->isCompetitionOwner($competition) && $joinedUsers->isNotEmpty())
    <div class="mt-1 mb-1" id="joinedUsersAccordion">
        <div class="accordion">
            <div class="accordion-item">
                <h2 class="accordion-header" id="joinedUsersHeading">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#joinedUsersCollapse" aria-expanded="true" aria-controls="joinedUsersCollapse">
                        Deelnemende gebruikers
                    </button>
                </h2>
                <div id="joinedUsersCollapse" class="accordion-collapse collapse show" aria-labelledby="joinedUsersHeading" data-bs-parent="#joinedUsersAccordion">
                    <div class="accordion-body">
                        <div class="card">
                            <div class="card-body">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Naam</th>
                                        <th>Email</th>
                                        <th>Acties</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($joinedUsers as $joinedUser)
                                        <tr>
                                            <td>{{ $joinedUser->name }} {{ $joinedUser->last_name }}</td>
                                            <td>{{ $joinedUser->email }}</td>
                                            <td>
                                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#removeUserModal{{ $joinedUser->id }}">Verwijder</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

@foreach ($joinedUsers as $joinedUser)
    <div id="removeUserModal{{ $joinedUser->id }}" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Gebruiker verwijderen</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Weet je zeker dat je de gebruiker wil verwijderen?</p>
                    <p>Alle inzendingen en beoordelingen van de gebruiker zullen verwijderd worden.</p>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('competition.removeUser', ['competitionId' => $competition->id, 'userId' => $joinedUser->id]) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuleer</button>
                        <button type="submit" class="btn btn-danger">Verwijder</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach
