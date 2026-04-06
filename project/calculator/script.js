document.addEventListener('DOMContentLoaded', () => {
    const opBtns = document.querySelectorAll('.op-btn');
    const num1Input = document.getElementById('num1');
    const num2Input = document.getElementById('num2');
    const display = document.getElementById('display');
    const clearBtn = document.getElementById('clearBtn');

    // Function to perform calculation instantly
    const calculate = () => {
        const num1 = parseFloat(num1Input.value);
        const num2 = parseFloat(num2Input.value);
        const checkedRadio = document.querySelector('input[name="operation"]:checked');
        const operation = checkedRadio ? checkedRadio.value : 'add';

        if (isNaN(num1) || isNaN(num2)) {
            display.textContent = '0.00';
            return;
        }

        let result = 0;
        switch (operation) {
            case 'add':
                result = num1 + num2;
                break;
            case 'subtract':
                result = num1 - num2;
                break;
            case 'multiply':
                result = num1 * num2;
                break;
            case 'divide':
                if (num2 === 0) {
                    display.textContent = 'Error';
                    return;
                }
                result = num1 / num2;
                break;
        }

        // Format nicely - max 4 decimal places
        display.textContent = Number.isInteger(result) ? result : parseFloat(result.toFixed(4));
        
        // Add a small pulse animation to show it updated
        display.style.transform = 'scale(1.02)';
        setTimeout(() => {
            display.style.transform = 'scale(1)';
        }, 150);
    };

    // Add event listeners for instant calculation on input change
    num1Input.addEventListener('input', calculate);
    num2Input.addEventListener('input', calculate);

    // Add event listeners for operator buttons
    opBtns.forEach(btn => {
        btn.addEventListener('click', (e) => {
            // Because the actual radio input is hidden, handle visual and selected classes smoothly
            opBtns.forEach(b => {
                b.classList.remove('selected');
                b.classList.remove('active');
            });
            btn.classList.add('selected');
            
            // Allow the radio context to toggle checked state before calculating
            setTimeout(calculate, 0); 
        });
    });

    // Handle clear button
    if (clearBtn) {
        clearBtn.addEventListener('click', () => {
            num1Input.value = '';
            num2Input.value = '';
            
            opBtns.forEach(b => {
                b.classList.remove('selected');
                b.classList.remove('active');
            });
            
            // Reset to Add operation visually and properly
            const addOpBtn = document.querySelector('input[value="add"]').closest('.op-btn');
            addOpBtn.classList.add('active');
            document.querySelector('input[value="add"]').checked = true;

            display.textContent = '0.00';
        });
    }
    
    // Add transition for the javascript-triggered styling
    display.style.transition = 'transform 0.15s ease-out';
});
