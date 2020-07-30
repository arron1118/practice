class Test {
    name = null;
    age = null;
    sex = null;

    constructor(...args) {
        console.log('constructor: ' + args);
        console.info(args);
        this.name = args[0].name;
        this.age = args[0].age;
        this.sex = args[0].sex;
    }

    getName() {
        return this.name;
    }

    Test(...args) {
        console.log('Test: ' + args);
    }
}


