@extends('layouts.app')
@section('content')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Roles</h1>
      <nav>
        <ol class="breadcrumb">
        </ol>
      </nav>
    </div>
    <section class="section">
        @if(session()->has('message'))
            <div class="alert alert-primary bg-tranparent border-0 alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('message') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="row">
          <div class="col-lg-10">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Veuillez renseigner le formulaire</h5>
  
                <!-- General Form Elements -->
                <form method="POST" action="{{ route("roles.update", $role->id) }}">
                    @csrf
                    @method("PUT")
                  <div class="row mb-3">
                    <label for="inputEmail" class="col-sm-2 col-form-label">Nom du role</label>
                    <div class="col-sm-10">
                      <input type="text" name="name" value="{{ $role->name }}" class="form-control @error('name') is-invalid @enderror" required>
                      @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                      @enderror

                    </div>
                  </div>
                  <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Sauvegarder</label>
                    <div class="col-sm-10">
                      <button type="submit" class="btn btn-primary">Sauvegarder</button>
                    </div>
                  </div>
                </form><!-- End General Form Elements -->
              </div>
            </div>

            <div class="card pt-3">
              <div class="card-body">
                <table class="display" id="myTable">
                  <thead>
                    <tr>
                      <th scope="col">Nom</th>
                      <th scope="col">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if ($role->permissions)
                        @foreach($role->permissions as $role_permission)
                          <tr>
                            <td>{{ $role_permission->name }}</td>
                            <td>
                              <form method="POST" action="{{ route("role.permissions.revoke", [$role->id, $role_permission->id]) }}">
                                @csrf
                                @method("DELETE")
                                <button type="submit" class="btn btn-transparent"><i class="bi bi-trash text-danger"></i></button>
                              </form>
                            </td>
                          </tr>
                          
                        @endforeach
                    @endif
                  </tbody>
                </table>
              </div>
            </div>

            <div class="card">
              <div class="card-body mt-3">
                <form action="{{ route("role.permissions", $role->id) }}" method="POST">
                  @csrf
                  <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Permissions</label>
                    <div class="col-sm-10">
                      <select class="form-select" name="permission">
                        @foreach ($permissions as $permission)
                          <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Assigner</label>
                    <div class="col-sm-10">
                      <button class="btn btn-primary">Assigner</button>
                    </div>
                  </div>
                  
                </form>
              </div>
            </div>
          </div>
        </div>
      </section>
  </main>

  <script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
</script>
@endsection