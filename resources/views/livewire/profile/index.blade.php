<div class="card card-primary card-outline">
    <div class="card-body box-profile">
        <div class="text-center">
            <img class="profile-user-img img-fluid img-circle"
                src="{{ asset('vendor/adminlte/dist/img/user4-128x128.jpg') }}" alt="User profile picture">
        </div>
        <h3 class="profile-username text-center">Nina Mcintire</h3>
        <p class="text-muted text-center">Software Engineer</p>
        <form>
            <div class="row g-3">
                <div class="col-12 col-md-6 input-group mb-3">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                        name="name" wire:model="name" required autocomplete="name" placeholder="Full name">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 input-group mb-3">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" wire:model="email" value="{{ old('email') }}" required autocomplete="email"
                        placeholder="Email">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
