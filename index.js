const express = require('express')
const {Admin} = require('./db/db')
const app = express()
app.use(express.json())

app.get('/', (req, res) => {
  res.send('Hello World!')
})

app.post('/add-admin', async(req, res) => {
  const { username, password } = req.body
    const otp = Math.floor(100000 + Math.random() * 900000); 
    await Admin.create({ username, password, otp })
  res.json({ received: { username, password, otp } })
})

const PORT = process.env.PORT || 3000
app.listen(PORT, () => {
  console.log(`Server is running on port ${PORT}`)
})