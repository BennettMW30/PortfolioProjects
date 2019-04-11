var express = require('express')
var Blockchain = require('./blockchain')
var bodyParser = require('body-parser')
var uuid = require('uuid/v1')
var nodeAddress = uuid().split('-').join('')
var app = express()

app.use(bodyParser.json())
app.use(bodyParser.urlencoded({ extended: false}))

const classcoin = new Blockchain()

console.log("Miner ID: " + nodeAddress)
//classcoin.createNewEnrollment(100, 'personA', 'personB')

app.get('/', function (req, res){
    res.send('Your web page')
})
app.get('/blockchain',function(req, res){
    //console.log(classcoin)
    res.send(classcoin)
})
app.get('/enrollment', function(req, res){
    res.sendFile('views/enrollmentview.html', {root: __dirname})
})
app.post('/enrollment', function(req, res){
    console.log(req.body.term)
    const newEnrollment = classcoin.createNewEnrollment(req.body.term, req.body.course, req.body.username)
    res.send(enrollmentview)
    //res.send(classcoin.pendingEnrollment)
    //res.json({ note: `pendingEnrollment: ${newEnrollment}`})
})
app.post('/postenrollment', function(req, res){
    var term = req.body.term
    var course = req.body.course
    var username = req.body.username

    classcoin.createNewEnrollment(term, course, username)

    var enrollmentData = [{term:term, course:course, username:username}]
    res.send(JSON.stringify(enrollmentData))
})

var port = 20000
app.listen(port, function(){
    console.log(`listening on port ${port}...`)
})
app.get('/mine', function(req, res){
    const lastBlock = classcoin.getLastBlock()
    const previousBlockHash = lastBlock['hash']
    const currentBlockData = {
        enrollments:classcoin.pendingEnrollment
    }
    const year = classcoin.getYear();
    const nonce = classcoin.proofOfWork(previousBlockHash, currentBlockData)[0]
    const blockHash = classcoin.proofOfWork(previousBlockHash, currentBlockData)[1]
    //classcoin.createNewEnrollment("Fall", "CompSci 451", "BennettMW30")
    const newBlock = classcoin.createNewBlock(year, nonce, blockHash, previousBlockHash)

    res.json({
        note: "Created New Block",
        newBlock: newBlock
    })
})
app.get('/display', function(req, res){
    const eString = classcoin.displayEnrollments()
    res.send(eString)
})
