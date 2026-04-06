<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A modern basic calculator built with HTML, CSS, and JavaScript.">
    <title>Modern Calculator</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="calculator-wrapper">
        <div class="calculator">
            <h1>CalcApp</h1>

            <div class="display" id="display">
                0.00
            </div>

            <form id="calcForm" onsubmit="event.preventDefault();">
                <div class="input-group">
                    <input type="number" step="any" name="num1" id="num1" placeholder="First Number" required>
                </div>
                <div class="input-group">
                    <input type="number" step="any" name="num2" id="num2" placeholder="Second Number" required>
                </div>
                
                <div class="operations">
                    <label class="op-btn active">
                        <input type="radio" name="operation" value="add" required checked>
                        <span class="icon">+</span>
                    </label>
                    <label class="op-btn">
                        <input type="radio" name="operation" value="subtract" required>
                        <span class="icon">-</span>
                    </label>
                    <label class="op-btn">
                        <input type="radio" name="operation" value="multiply" required>
                        <span class="icon">×</span>
                    </label>
                    <label class="op-btn">
                        <input type="radio" name="operation" value="divide" required>
                        <span class="icon">÷</span>
                    </label>
                </div>

                <div class="actions">
                    <button type="button" class="clear-btn" id="clearBtn" style="flex: 1;">Clear</button>
                </div>
            </form>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>
