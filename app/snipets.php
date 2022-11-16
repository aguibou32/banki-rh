<?php

$user = Auth::user();
        if (!$user->hasPermissionTo('voir départements')) {
            return redirect()->back();
}

@include('utils.data_table')
recent-sales overflow-auto

'matricule' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($user2->id)],
'id_number' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($user2->id) ],


if ($post->author !== auth()->user()->id || auth()->user()->cannot('edit posts'))
{abort(404);// or some other 
}

whereNotIn('name', ['Super Admin'])->get();

@error('')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
@enderror

@error('') is-invalid @enderror

@if($variables->hasPages())
<nav class="Page navigation example">
  <div class="pagination">
      {{ $variables->links() }}
  </div>
</nav>
@endif


use Illuminate\Support\Facades\Auth;

$user = Auth::user();
auth()->user()->email; // in blade

<form method="POST" action="{{ route("pays.destroy", $pay->id) }}">
@csrf
@method("DELETE")
<button type="submit" class="btn btn-transparent"><i class="bi bi-trash text-danger"></i></button>
</form>

public function __construct()
{
    $this->middleware('password.confirm', ['only' => ['create', 'store']] );
}

onclick="return confirm('Etes-vous sûr de vouloir effectuer cette action ?');" 


$user = Auth::user();
$rapport = Rapport::findOrFail($id);
if (!($user->id == $rapport->user_id)) {
    return redirect()->back();
}else{}


$date = date('d F, Y', strtotime($contrat->date));

{{ $division->created_at->formatLocalized('%d %B %Y') }}

class="display"

class="card recent-sales overflow-auto"

Carbon\Carbon::parse($contrat->debut)->formatLocalized('%d %B %Y')