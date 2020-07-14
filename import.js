
import {test} from './export.js';

let cl = class {
    a = 100;

    t() {
        return 999;
    }

    ts() {
        console.info(test());
    }
}

let Test = {
    a: 88,
    fun: function () {
        let Name = prompt('Name: ', 'Your Name Please');
        return 'My Name Is ' + Name;
    }
}