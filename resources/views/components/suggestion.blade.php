
<div class="my-2 shadow  text-white bg-dark p-1" id="">
  <div class="d-flex justify-content-between">
    <table class="ms-1 w-100" id="table"> 
      @foreach($suggestionsUsers as $key => $suggestionsUser)
        <tr>
          <td class="align-middle" style="width:10%" id="suggestion_name">{{ $suggestionsUser['name'] }}</td>
          <td class="align-middle"> - </td>
          <td class="align-middle" style="width:40%" id="suggestion_email">{{ $suggestionsUser['email'] }}</td>
          <td class="align-middle" style="width:50%"> 
          <div class="d-flex justify-content-end w-100">
            <button id="create_request_btn_{{ $suggestionsUser['id'] }}" class="btn btn-primary me-1 connect_user_btn" data-suggestion_id="{{ $suggestionsUser['id'] }}" data-user_id="{{ auth()->user()->id }}">Connect</button>
          </div>
        </td>
        </tr>
      @endforeach
    </table>
    {{-- <div>
      <button id="create_request_btn_" class="btn btn-primary me-1">Connect</button>
    </div> --}}
  </div>
</div>
