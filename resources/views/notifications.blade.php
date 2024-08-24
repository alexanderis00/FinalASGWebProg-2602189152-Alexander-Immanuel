<div id="notifications-container">
</div>

<script>
    function loadNotifications() {
        fetch('/notifications')
            .then(response => response.json())
            .then(data => {
                const container = document.getElementById('notifications-container');
                container.innerHTML = '';

                data.forEach(notification => {
                    const notificationElement = document.createElement('div');
                    notificationElement.className = notification.read ? 'notification read' : 'notification';
                    notificationElement.innerHTML = `<p>${notification.data}</p><button onclick="markAsRead(${notification.id})">Mark as Read</button>`;
                    container.appendChild(notificationElement);
                });
            });
    }

    function markAsRead(id) {
        fetch(`/notifications/${id}/read`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            loadNotifications();
        });
    }

    loadNotifications();
</script>
