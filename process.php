<?php
include 'MatrixCalculator.php';

// Функція для генерації випадкових значень матриці
function generateRandomMatrix($rows, $cols)
{
	$matrix = [];
	for ($i = 0; $i < $rows; $i++) {
		for ($j = 0; $j < $cols; $j++) {
			$matrix[$i][$j] = rand(1, 20); // Генерація випадкових чисел від 1 до 20
		}
	}
	return $matrix;
}

// Функція для перевірки, чи є введені матриці коректними
function validateMatrices($matrixA, $matrixB)
{
	// Перевірка на порожні матриці
	if (empty($matrixA) || empty($matrixB)) {
		return false;
	}

	if (count($matrixA) != count($matrixB)) {
		return false;
	}
	for ($i = 0; $i < count($matrixA); $i++) {
		if (count($matrixA[$i]) != count($matrixB[$i])) {
			return false;
		}
	}
	return true;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	// Отримуємо розмірності матриць та операцію
	$rows = $_POST['rows'];
	$cols = $_POST['cols'];
	$operation = $_POST['operation'];

	// Генерація матриць A та B
	$matrixA = [];
	$matrixB = [];

	if (isset($_POST['matrixA']) && isset($_POST['matrixB'])) {
		// Якщо матриці введені вручну користувачем
		$matrixA = $_POST['matrixA'];
		$matrixB = $_POST['matrixB'];

		// Перевірка коректності введених матриць
		if (!validateMatrices($matrixA, $matrixB)) {
			$error = "Матриці мають різні розміри або порожні. Операція неможлива.";
			header("Location: index.php?error=" . urlencode($error));
			exit();
		}
	} else {
		// Якщо потрібно згенерувати випадкові матриці
		$matrixA = generateRandomMatrix($rows, $cols);
		$matrixB = generateRandomMatrix($rows, $cols);
	}

	// Створюємо об'єкт класу MatrixCalculator
	$matrixCalculator = new MatrixCalculator($matrixA, $matrixB);

	// Виконуємо операцію
	$result = null;
	$error = null;
	switch ($operation) {
		case 'add':
			$result = $matrixCalculator->add();
			break;
		case 'subtract':
			$result = $matrixCalculator->subtract();
			break;
		case 'multiply':
			$result = $matrixCalculator->multiply();
			break;
		case 'transpose':
			// Для транспонування вибираємо лише одну матрицю
			$matrixToTranspose = isset($_POST['transposeMatrix']) && $_POST['transposeMatrix'] === 'B' ? $matrixB : $matrixA;
			$result = $matrixCalculator->transpose($matrixToTranspose);
			break;
		default:
			$error = "Операція не визначена.";
	}

	// Перевірка на помилку в операціях (наприклад, при множенні)
	if (is_string($result)) {
		$error = $result;
		$result = null;
	}

	// Повертаємо результат на головну сторінку (index.php)
	if ($error) {
		header("Location: index.php?error=" . urlencode($error));
	} else {
		$resultJson = json_encode($result);  // Перетворюємо результат у JSON для простоти передачі
		header("Location: index.php?result=" . urlencode($resultJson));
	}
	exit();
}
