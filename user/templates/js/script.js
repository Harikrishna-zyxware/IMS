function Validate()
{
    var input = document.getElementById('input_name').value;

    if(input === '') {
        alert("Form is empty");
        return false;
    } 
    else {
        return true;
    }
}