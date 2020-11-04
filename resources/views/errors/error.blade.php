@if ($errors->any())
  
    <ul class="dangerNotification notification is-danger">
        @foreach ($errors->all() as $error)

            <li>{{ $error }}</li>

        @endforeach
    </ul>

@endif