const mongoose = require('mongoose');

const userSchema = new mongoose.Schema({
    username: { type: String, required: true },
    password: { type: String, required: true },
    id_number: { type: String, required: true },
    email: { type: String, required: true },
    seating: { type: String, required: true },
    branch: { type: String, required: true },
    section: { type: String, required: true },
    otp: { type: String, required: true }
}, { timestamps: true });

module.exports = mongoose.model('User', userSchema);
