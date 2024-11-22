const nodemailer = require('nodemailer');

const transporter = nodemailer.createTransport({
    service: 'gmail',
    auth: {
        user: 'eleccionesuta@gmail.com',  
        pass: 'twal mrbl phoo humi'         // La contraseña de aplicación que generaste
    }
});

const sendMail = (to, subject, message) => {
    const mailOptions = {
        from: '"UNIVERSIDAD TECNICA DE AMBATO" <eleccionesuta@gmail.com>',
        to: to,
        subject: subject,
        text: message
    };

    return transporter.sendMail(mailOptions);
};

module.exports = { sendMail };
