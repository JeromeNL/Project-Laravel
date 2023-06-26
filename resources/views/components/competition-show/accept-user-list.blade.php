@if(Auth::check() && Auth::user()->isCompetitionOwner($competition) && $competition['private'])
    <div class="row">
        <div class="col">
            <table class="table-sort table-arrows table table-hover">
                <thead>
                <tr>
                    <th>Email</th>
                    <th>Naam</th>
                    <th class="disable-sort">Acties</th>
                </tr>
                </thead>
                <tbody>
                @foreach($usersWithJoinRequests as $userWithJoinRequest)
                    <tr>
                        <td>{{ $userWithJoinRequest->email }}</td>
                        <td>{{ $userWithJoinRequest->name }} {{ $userWithJoinRequest->last_name }}</td>
                        <td>
                            <form
                                action="{{ route('competition.acceptUser', ['competition' => $competition, 'user' => $userWithJoinRequest]) }}"
                                method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" value="0" class="btn btn-outline-danger" name="accepted"><i
                                        class="fa-solid fa-xmark"></i></button>
                                <button type="submit" value="1" class="btn btn-outline-success" name="accepted"><i
                                        class="fa-solid fa-check"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endif
