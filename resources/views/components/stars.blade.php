<div class="d-inline-block">
    @for($i = 0; $i < floor($amount); $i++)
        <i class="fa-solid fa-star fa-xl text-warning"></i>
    @endfor
    @if($amount - floor($amount) > 0)
        <i class="fa-solid fa-star-half fa-xl text-warning"></i>
    @endif
</div>


