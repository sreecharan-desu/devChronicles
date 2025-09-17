const mongoose = require('mongoose');
const dotenv = require('dotenv');

dotenv.config();

const MONGO_URI = process.env.MONGO_URI;

mongoose.connect(MONGO_URI)
.then(() => console.log("Connected to MongoDB"))
.catch(err => console.error("Error connecting to MongoDB:", err));

const User = require('./collections/user');
const Admin = require('./collections/admin');
const Room = require('./collections/rooms');

module.exports = { User, Admin, Room };