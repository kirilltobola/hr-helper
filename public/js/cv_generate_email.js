
const source = document.getElementById('name-id');
const result = document.getElementById('email-id');

const inputHandler = function(e) {
    const suffix = '-dev@adict.ru';
    let inp = e.target.value.split(/\s+/);
    if (inp.length > 1) {
        let name = translitirate(inp[0].toLowerCase());
        let surname = translitirate(inp[1].toLowerCase().charAt(0));
        result.value = (name + '.' + surname) + suffix;
    } else {
        let name = inp[0];
        name = translitirate(name.toLowerCase());
        result.value = name + suffix;
    }
}
if (source) {
    source.addEventListener('input', inputHandler);
    source.addEventListener('change', inputHandler);
}

function translitirate(str) {
    const alphabet = {
        'а': 'a',
        'б': 'b',
        'в': 'v',
        'г': 'g',
        'д': 'd',
        'е': 'e',
        'ё': 'e',
        'ж': 'zh',
        'з': 'z',
        'и': 'i',
        'й': 'i',
        'к': 'k',
        'л': 'l',
        'м': 'm',
        'н': 'n',
        'о': 'o',
        'п': 'p',
        'р': 'r',
        'с': 's',
        'т': 't',
        'у': 'u',
        'ф': 'f',
        'х': 'kh',
        'ц': 'ts',
        'ч': 'ch',
        'ш': 'sh',
        'щ': 'shch',
        'э': 'ye',
        'ю': 'yu',
        'я': 'ya',
    }

    let res = '';
    for(let i = 0; i < str.length; i++) {
        if (alphabet[str[i]]) {
            res += alphabet[str[i]];
        } else {
            res += str[i];
        }
    }
    return res;
}
