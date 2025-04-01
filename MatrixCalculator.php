<?php
class MatrixCalculator
{
	private $matrixA;
	private $matrixB;

	// Конструктор для ініціалізації матриць
	public function __construct($matrixA, $matrixB = null)
	{
		$this->matrixA = $matrixA;
		$this->matrixB = $matrixB;
	}

	// Генерація випадкової матриці
	public function generateRandomMatrix($rows, $cols, $min = 1, $max = 10)
	{
		$matrix = [];
		for ($i = 0; $i < $rows; $i++) {
			for ($j = 0; $j < $cols; $j++) {
				$matrix[$i][$j] = rand($min, $max); // Генерація випадкового числа
			}
		}
		return $matrix;
	}

	// Перевірка на однаковий розмір
	private function checkMatrixSize()
	{
		$rowsA = count($this->matrixA);
		$colsA = count($this->matrixA[0]);
		$rowsB = count($this->matrixB);
		$colsB = count($this->matrixB[0]);

		if ($rowsA != $rowsB || $colsA != $colsB) {
			return false;
		}
		return true;
	}

	// Метод для додавання матриць
	public function add()
	{
		if (!$this->checkMatrixSize()) {
			return "Матриці мають різний розмір. Додавання неможливе.";
		}

		$rows = count($this->matrixA);
		$cols = count($this->matrixA[0]);
		$result = [];

		// Додавання елементів
		for ($i = 0; $i < $rows; $i++) {
			for ($j = 0; $j < $cols; $j++) {
				$result[$i][$j] = $this->matrixA[$i][$j] + $this->matrixB[$i][$j];
			}
		}
		return $result;
	}

	// Метод для віднімання матриць
	public function subtract()
	{
		if (!$this->checkMatrixSize()) {
			return "Матриці мають різний розмір. Віднімання неможливе.";
		}

		$rows = count($this->matrixA);
		$cols = count($this->matrixA[0]);
		$result = [];

		// Віднімання елементів
		for ($i = 0; $i < $rows; $i++) {
			for ($j = 0; $j < $cols; $j++) {
				$result[$i][$j] = $this->matrixA[$i][$j] - $this->matrixB[$i][$j];
			}
		}
		return $result;
	}

	// Метод для множення матриць
	public function multiply()
	{
		$rowsA = count($this->matrixA);
		$colsA = count($this->matrixA[0]);
		$rowsB = count($this->matrixB);
		$colsB = count($this->matrixB[0]);
		$result = [];

		// Перевірка на можливість множення
		if ($colsA != $rowsB) {
			return "Кількість стовпців першої матриці повинна дорівнювати кількості рядків другої матриці.";
		}

		// Множення матриць
		for ($i = 0; $i < $rowsA; $i++) {
			for ($j = 0; $j < $colsB; $j++) {
				$result[$i][$j] = 0;
				for ($k = 0; $k < $colsA; $k++) {
					$result[$i][$j] += $this->matrixA[$i][$k] * $this->matrixB[$k][$j];
				}
			}
		}
		return $result;
	}

	// Метод для транспонування матриці
	public function transpose($matrix)
	{
		$rows = count($matrix);
		$cols = count($matrix[0]);
		$result = [];

		// Транспонування матриці
		for ($i = 0; $i < $cols; $i++) {
			for ($j = 0; $j < $rows; $j++) {
				$result[$i][$j] = $matrix[$j][$i];
			}
		}
		return $result;
	}

	// Додатковий метод для виведення матриці
	public function printMatrix($matrix)
	{
		$output = '<table border="1">';
		foreach ($matrix as $row) {
			$output .= '<tr>';
			foreach ($row as $cell) {
				$output .= '<td>' . htmlspecialchars($cell) . '</td>';
			}
			$output .= '</tr>';
		}
		$output .= '</table>';
		return $output;
	}
}
