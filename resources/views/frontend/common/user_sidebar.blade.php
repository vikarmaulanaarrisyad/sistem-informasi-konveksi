  <br>
  <img src="card-img-top mb-3" style="border-radius: 50%" height="100%" width="100"5 alt="">
  <li class="list-group list-group-flush">
      <a href="{{ url('/') }}" class="btn btn-primary btn-sm btn-block">Home</a>
      <a href="{{ route('user.order') }}" class="btn btn-primary btn-sm btn-block">My
          Order</a>
      <a href="{{ route('user.profile.edit') }}" class="btn btn-primary btn-sm btn-block">Profile
          Update</a>
      <a href="{{ route('change.password') }}" class="btn btn-primary btn-sm btn-block">Change
          Password</a>
      <a href="{{ route('user.logout') }}" class="btn btn-danger btn-sm btn-block">Logout</a>
  </li>
