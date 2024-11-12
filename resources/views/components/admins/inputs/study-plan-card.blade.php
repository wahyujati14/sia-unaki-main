<select name="study_plan_card_id" id="" class="form-control m-1">
    <option value="">Pilih KRS</option>
    @foreach ($cards as $card)
        <option value="{{ $card->id }}" @selected($card->id == $value)>
            {{ $card->user->name }} - {{ $card->academic_year->toDescriptionString() }}
        </option>
    @endforeach
</select>