<div class="form-group ">
<label class="d-block"> Member <span class="text-danger">*</span><br class="">

    <select class="form-control " name="member_id" >
        @foreach ($members as $member)
        <option value="{{ $member->id }}">{{ $member->name ?? '' }} ({{ $member->member_code ?? '' }})</option>
        @endforeach
    </select>
</div>   