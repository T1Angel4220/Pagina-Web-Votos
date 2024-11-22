const express = require('express');
const { sendMail } = require('./service/emailService'); // Importa la función desde emailService.js

const app = express();

// Middleware para analizar JSON
app.use(express.json());  // Asegúrate de que estás usando este middleware para recibir JSON

app.post('/send-email', (req, res) => {
    const { to, subject, message } = req.body;


    if (!to || !subject) {
        return res.status(400).send('Faltan parámetros de correo');
    }

    sendMail(to, subject, message)
        .then(info => {
            res.status(200).send('Correo enviado con éxito: ' + info.response);
        })
        .catch(error => {
            console.error('Error al enviar el correo:', error);
            res.status(500).send('Error al enviar el correo: ' + error.message);
        });
});


// Escucha en el puerto 3000
const PORT = 3001;
app.listen(PORT, () => {
    console.log(`Servidor corriendo en el puerto ${PORT}`);
});
