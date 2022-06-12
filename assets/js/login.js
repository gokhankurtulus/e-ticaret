const isNumericInput = (event) => {
    const key = event.keyCode;
    return ((key >= 48 && key <= 57) || // Allow number line
        (key >= 96 && key <= 105) // Allow number pad
    );
};

const isModifierKey = (event) => {
    const key = event.keyCode;
    return (event.shiftKey === true || key === 35 || key === 36) || // Allow Shift, Home, End
        (key === 8 || key === 9 || key === 13 || key === 46) || // Allow Backspace, Tab, Enter, Delete
        (key > 36 && key < 41) || // Allow left, up, right, down
        (
            // Allow Ctrl/Command + A,C,V,X,Z
            (event.ctrlKey === true || event.metaKey === true) &&
            (key === 65 || key === 67 || key === 86 || key === 88 || key === 90)
        )
};

const enforceFormat = (event) => {
    // Input must be of a valid number format or a modifier key, and not longer than ten digits
    if (!isNumericInput(event) && !isModifierKey(event)) {
        event.preventDefault();
    }
};

const formatToPhone = (event) => {
    if (isModifierKey(event)) {
        return;
    }

    const target = event.target;
    const input = event.target.value.replace(/\D/g, '').substring(0, 10); // First ten digits of input only
    const zip = input.substring(0, 3);
    const middle = input.substring(3, 6);
    const last = input.substring(6, 10);

    if (input.length > 6) {
        target.value = `(${zip}) ${middle} - ${last}`;
    } else if (input.length > 3) {
        target.value = `(${zip}) ${middle}`;
    } else if (input.length > 0) {
        target.value = `(${zip}`;
    }
};

const inputElement = document.getElementById('phoneNumber');
if (inputElement) {
    inputElement.addEventListener('keydown', enforceFormat);
    inputElement.addEventListener('keyup', formatToPhone);
}

function blockChars(elem, lang = 'en') {
    let regex;
    if (lang === 'en')
        regex = new RegExp("^[a-zA-Z]+$");
    if (lang === 'tr')
        regex = new RegExp("^[a-zA-Z0-9ığüşöçĞÜŞÖÇİ]+$");
    if (lang === 'pw')
        //regex = new RegExp("^[a-zA-Z0-9ığüşöçĞÜŞÖÇİ!@#$%&*+-]+$");
        regex = new RegExp("^[a-zA-Z0-9ığüşöçĞÜŞÖÇİ.,:;!'&()=?_><|£#${}\[\\]\\\\*%/+-]+$");
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);

    if (!regex.test(key) && event.keyCode !== 13) {
        event.preventDefault();
        return false;
    }
}

// Bind to the submit event of our form
let loginForm = "#loginForm";
let loader = "#loader";
let ajaxUrI = "testAJAX.php";
if ($(loginForm).length) {
    $(loginForm).submit(function (event) {
        event.preventDefault();
        //$(loader).css("display","block");
        var values = $(this).serialize();

        $.ajax({
            url: ajaxUrI,
            type: "post",
            data: values,
            success: function (response) {
                //$(loader).css("display","none");
                document.location.reload(true);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        }).done(function (data) {
            console.log(data)
        });
    });
}

if (window.history.replaceState) {

    window.history.replaceState(null, null, window.location.href);

}