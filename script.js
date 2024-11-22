document.getElementById("order-form").addEventListener("submit", function(event) {
    event.preventDefault();

    // Ambil data dari formulir
    const whatsappNumber = document.getElementById("whatsapp-number").value;
    const rentalDuration = document.getElementById("rental-duration").value;
    const customerName = document.getElementById("customer-name").value;

    // Cek validasi sederhana
    if (whatsappNumber && rentalDuration && customerName) {
        alert(`Pesanan Anda berhasil! \nNomor WhatsApp: ${whatsappNumber} \nDurasi Sewa: ${rentalDuration} hari \nNama: ${customerName}`);
    } else {
        alert("Semua kolom harus diisi!");
    }

    // Fungsi untuk membuka/menutup chat
function toggleChat() {
    const chatBox = document.getElementById('chat-box');
    chatBox.style.display = (chatBox.style.display === 'none' || chatBox.style.display === '') ? 'block' : 'none';
}

// Fungsi untuk menutup chat
function closeChat() {
    document.getElementById('chat-box').style.display = 'none';
}

// Fungsi untuk menangani pengiriman pesan
document.getElementById('chat-form').addEventListener('submit', function(event) {
    event.preventDefault();
    
    const messageInput = document.getElementById('message');
    const message = messageInput.value.trim();

    if (message) {
        // Menambahkan pesan ke dalam chat
        const messageContainer = document.getElementById('chat-messages');
        const userMessage = document.createElement('p');
        userMessage.classList.add('user-message');
        userMessage.textContent = message;
        messageContainer.appendChild(userMessage);

        // Scroll chat ke bawah agar pesan terbaru terlihat
        messageContainer.scrollTop = messageContainer.scrollHeight;

        // Kirim pesan ke server untuk diproses lebih lanjut (misalnya, menyimpannya atau mengirim email)
        fetch('submit_message.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: 'message=' + encodeURIComponent(message)
        });

        // Reset input
        messageInput.value = '';
    }
});

});
