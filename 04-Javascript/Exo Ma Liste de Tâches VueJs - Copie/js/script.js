const { createApp } = Vue;

const app = createApp({});

app.component('app-calculatrice', {
    template: '#calculatrice-template',
    data() {
        return {
            currentNumber: '',
            previousNumber: null,
            operation: null,
            resetScreen: false
        };
    },
    methods: {
        entrerChiffre(number) {
            if (this.resetScreen) {
                this.currentNumber = '';
                this.resetScreen = false;
            }
            if (number === '.' && this.currentNumber.includes('.')) return;
            this.currentNumber += number;
        },
        effacer() {
            this.currentNumber = '';
            this.previousNumber = null;
            this.operation = null;
        },
        choisirOperation(op) {
            if (this.currentNumber === '') return;
            if (this.previousNumber !== null) {
                this.calculer();
            }
            this.operation = op;
            this.previousNumber = this.currentNumber;
            this.resetScreen = true;
        },
        calculer() {
            if (this.operation === null || this.previousNumber === null) return;
            let result;
            const prev = parseFloat(this.previousNumber);
            const current = parseFloat(this.currentNumber);

            switch (this.operation) {
                case '+':
                    result = prev + current;
                    break;
                case '-':
                    result = prev - current;
                    break;
                case '*':
                    result = prev * current;
                    break;
                case '/':
                    result = prev / current;
                    break;
                default:
                    return;
            }

            this.currentNumber = result.toString();
            this.operation = null;
            this.previousNumber = null;
            this.resetScreen = true;
        }
    }
});

app.mount('#app');