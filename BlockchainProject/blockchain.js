function Blockchain(){
    this.chain = [];
    this.pendingEnrollment = [];
    this.index = [];
    this.timestamp = [];
    this.nonce = [];
    this.hash = [];
    this.year = 2019;
    this.schoolname = "UW-Whitewater"
    this.previousBlockHash = [];
    this.createNewBlock(0, "Genesis", "Genesis", "Genesis")
}
Blockchain.prototype.getYear = function(){
    const year = 2019
}
Blockchain.prototype.createNewBlock = function(year, schoolname, nonce, hash, prevHash){
    var newBlock = {
        index:this.chain.length+1,
        timestamp:Date.now(),
        year:year,
        enrollment:this.pendingEnrollment,
        nonce:nonce,
        hash:hash,
        previousBlockHash:prevHash,
        schoolname:schoolname
    }
    this.chain.push(newBlock);
    this.pendingEnrollment=[];
    return newBlock;
}
Blockchain.prototype.getLastBlock = function(){
    return this.chain[this.chain.length - 1]
}
Blockchain.prototype.createNewEnrollment = function(term, course, username){
    const newEnrollment = {
        term: term, //From account
        course: course, //To account
        username: username //username
    }
    //Add enrollment array
    this.pendingEnrollment.push(newEnrollment);
    //Increase index
    return this.getLastBlock()['index'] + 1
}
var sha = require('sha256')
/*Blockchain.prototype.hashBlock = function(previousBlockHash, enrollmentData, nonce){
    var hashvalue = sha(previousBlockHash+JSON.stringify(enrollmentData)+nonce.toString())
    return hashvalue;
}*/
Blockchain.prototype.proofOfWork = function(previousBlockHash, currentBlockData){
    var nonce = 0
    var temp = ''
    while(temp[0] != '0' || temp[1] != '0' || temp[2] != '0' || temp[3] != '0'){
        temp = sha(previousBlockHash+JSON.stringify(currentBlockData)+nonce.toString())
        nonce++
    }
    return [nonce, temp]

    /*var nonce = 0
    var hash = this.hashblock(previousBlockHash, currentBlockData, nonce)
    while(hash.substring(0,3) != '000')
    {
        nonce++
        hash = this.hashblock(previousBlockHash, currentBlockData, nonce)
    }
    return nonce;*/
}
Blockchain.prototype.previousBlockHash = function(){
    const lastBlock = this.getLastBlock()
    const prevHash = lastBlock.hash

    return prevHash
}
Blockchain.prototype.displayEnrollments = function(){

    var jsonData = ""
    var eString = []
    var result = ""

    for(var i = 1; i < this.chain.length; i++){
        eString += JSON.stringify(this.chain[i].enrollment)
        jsonData = JSON.stringify(this.chain[i].enrollment)
        var obj = JSON.parse(jsonData)
        result += obj
    }

    return eString
}
module.exports = Blockchain