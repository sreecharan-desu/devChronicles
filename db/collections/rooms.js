const mongoose = require('mongoose');

const roomSchema = new mongoose.Schema({
    room_no: { type: String, required: true },
    no_of_benches: { type: Number, required: true },
    capacity: { type: Number, required: true }
}, { timestamps: true });

module.exports = mongoose.model('Room', roomSchema);
