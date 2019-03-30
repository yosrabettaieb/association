function getFile(filePath) {
    return filePath.substr(filePath.lastIndexOf('\\') + 1).split('.')[0];
}

function getoutput() {

    document.getElementById('ext').value = document.getElementById('fillle').value.split('.')[1];

    document.getElementById('pat').value='.'+ document.getElementById('ext').value;


}
function getoutput2(){
    document.getElementById('extension').value = document.getElementById('fille').value.split('.')[1];
    document.getElementById('pathem').value='.'+ document.getElementById('extension').value;

}