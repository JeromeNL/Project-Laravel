<x-html :title="'Inzendingen beoordelen'">
    <head>
        <link rel="stylesheet" href="{{ asset('css/stars.css') }}">
        <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    </head>
    @if (flash()->message && !flash()->error)
        <div class="{{ flash()->class }} alert alert-success">
            {{ flash()->message }}
        </div>
    @endif
    @if (flash()->error)
        <div class="{{ flash()->class }} alert alert-danger">
            {{ flash()->message }}
        </div>
    @endif
    <x-competition-show.competition-information :competition="$competition" :customLink="$customLink" :joined="$joined"/>
    <x-competition-show.manage-users :joinedUsers="$joinedUsers" :competition="$competition"/>
    <x-competition-show.winner-section :competition="$competition" :winnerEmail="$winnerEmail" :fileIsPdf="$fileIsPdf" :winningSubmissionUrl="$winningSubmissionUrl" :winningSubmission="$winningSubmission"/>
    <x-competition-show.accept-user-list :competition="$competition" :usersWithJoinRequests="$usersWithJoinRequests"/>
    <x-competition-show.submission-list :competition="$competition" :submissions="$submissions" :joined="$joined" :user="$user"/>
</x-html>
