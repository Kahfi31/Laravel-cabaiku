<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cabai-Bot</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css2?family=Krona+One&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Krona One', sans-serif;
        }
        body {
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            weight: 200vh;
            text-align: left;
        }
        .container {
            width: 90%;
            max-width: 1500px;
            margin-left : 150px;
            margin-top : -80px;
        }
        .header {
            position: absolute;
            top: 20px;
            left: 20px;
            font-size: 28px;
            font-weight: bold;
            background: linear-gradient(to right, #8B0000, #8B5A00, #8BAF00);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .title {
    font-size: 50px;
    font-weight: bold;
    background: linear-gradient(to right, #8B0000, #8B5A00, #8BAF00);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    margin-bottom: 10px;
    display: flex;
    flex-wrap: wrap;
    flex-direction: column;
}

.title .top-text {
    display:block;
    white-space: nowrap; /* Mencegah teks turun ke bawah */
    width : 100%;
    max-width: 800px;
}

.title .bottom-text {
    display: block;
}
        .description {
            font-size: 24px;
            background: linear-gradient(to right, #8B0000, #8B5A00, #8BAF00);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-align: left;
            margin-bottom: 20px;
            width: 90%;
            max-width: 1100px;
        }
        .chat-box {
            background: #7A955B;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            text-align: left;
            border: 2px solid #7A955B;
            margin-top : 80px;
            width: 90%;
            max-width: 1100px;
        }
        .chat-container {
            width: 100%;
        }
        #message {
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            border: 2px solid #7A955B;
            background: #7A955B;
            color: white;
            outline: none;
            resize: none;
            height: 50px;
            font-size: 16px;
        }
        .chat-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 10px;
        }
        .image-upload {
            display: flex;
            align-items: center;
            gap: 5px;
            cursor: pointer;
            color: white;
            font-size: 14px;
        }
        #sendMessage {
            background: none;
            border: none;
            cursor: pointer;
            font-size: 20px;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">CABAI-BOT</div>
        <div class="title">
            <span class="top-text">Halo! Saya asisten prediksi</span>
            <span class="bottom-text">hama.</span>
        </div>

        <div class="description">
            Beri tahu saya tanaman yang Anda tanam dan gejala yang terlihat,
            saya akan membantu memprediksi kemungkinan hama yang
            menyerang!
        </div>
        <div class="chat-box">
            <textarea id="message" placeholder="Ketikkan pertanyaan..." maxlength="1000"></textarea>
            <div class="chat-footer">
                <label class="image-upload">
                    <input type="file" id="imageInput" accept="image/*" style="display: none;"> 📷 Use Image
                </label>
                <button id="sendMessage">▶</button>
            </div>
        </div>
    </div>
</body>
</html>

    <script>
        document.getElementById("sendMessage").addEventListener("click", function() {
            const message = document.getElementById("message").value.trim();
            const imageInput = document.getElementById("imageInput");
            const imageFile = imageInput.files[0];
            const chatMessages = document.getElementById("chatMessages");

            if (!message && !imageFile) {
                alert("Harap ketik pesan atau unggah gambar sebelum mengirim.");
                return;
            }

            const formData = new FormData();
            formData.append("message", message);
            if (imageFile) {
                formData.append("image", imageFile);
            }

            chatMessages.innerHTML += `<p class="user-message"><strong>Anda:</strong> ${message}</p>`;
            if (imageFile) {
                chatMessages.innerHTML += `<p class="user-message"><strong>Anda:</strong><br><img src="${URL.createObjectURL(imageFile)}" style="max-width: 100px; border-radius: 5px;"></p>`;
            }

            var placeholder = document.createElement("p");
            placeholder.className = "bot-message";
            placeholder.innerHTML = "<strong>Bot:</strong> Sedang memproses...";
            chatMessages.appendChild(placeholder);
            chatMessages.scrollTop = chatMessages.scrollHeight;

            fetch("/chatbot/analyze", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                var botResponse = data.reply;
                if (typeof botResponse === "object" && botResponse.parts) {
                    botResponse = botResponse.parts.map(part => part.text).join(" ");
                }

                botResponse = botResponse.replace(/\*\*(.*?)\*\*/g, "<b>$1</b>");
                botResponse = botResponse.replace(/(\d+)\./g, "<br><br>$1.");
                botResponse = botResponse.replace(/\*(.*?)\*/g, "<br>- $1");

                placeholder.innerHTML = `<strong>Bot:</strong> ${botResponse}`;
                chatMessages.scrollTop = chatMessages.scrollHeight;
            })
            .catch(error => {
                console.error("Error:", error);
                placeholder.innerHTML = "<strong>Bot:</strong> Maaf, terjadi kesalahan.";
            });

            document.getElementById("message").value = "";
            imageInput.value = "";
            document.getElementById("imagePreview").innerHTML = "";
        });

        function previewImage() {
            const imageInput = document.getElementById("imageInput");
            const imagePreview = document.getElementById("imagePreview");

            imagePreview.innerHTML = "";
            if (imageInput.files.length > 0) {
                const file = imageInput.files[0];
                const imgElement = document.createElement("img");
                imgElement.src = URL.createObjectURL(file);
                imagePreview.appendChild(imgElement);
            }
        }
    </script>
</body>
</html>
