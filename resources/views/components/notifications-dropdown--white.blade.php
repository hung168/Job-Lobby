<!-- Add a new dropdown for notifications -->
<div class="dropdown">
    <button class="text-white rounded-lg py-1 px-2 font-semibold" data-bs-toggle="dropdown" aria-expanded="false" style="display: flex; align-items: center;">
        <span class="mr-1">
            <i class="fa-solid fa-bell" style="font-size: 48px;"></i>
        </span>
        Notifications
    </button>
    <!-- Use a loop to display the notifications using $notifications -->
    <ul class="dropdown-menu">
        @foreach ($notifications as $notification)
        <li><span class="dropdown-item">
                <strong>{{ $notification->data['subject'] }}</strong><br>
                {{ $notification->data['content'] }}
            </span>
        </li>
        @endforeach
    </ul>
</div>