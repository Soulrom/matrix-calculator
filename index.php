<?php
// Перевірка наявності результату в GET-запиті
$result = isset($_GET['result']) ? json_decode($_GET['result'], true) : null;
$error = isset($_GET['error']) ? $_GET['error'] : null; // Перевірка на помилки

// Ініціалізація змінних для матриць
$matrixA = null;
$matrixB = null;
$rows = 3;  // За замовчуванням 3x3
$cols = 3;

// Перевірка, чи була відправлена форма з розмірами
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['rows']) && isset($_POST['cols'])) {
	$rows = $_POST['rows'];
	$cols = $_POST['cols'];

	// Генерація випадкових матриць
	$matrixA = generateRandomMatrix($rows, $cols);
	$matrixB = generateRandomMatrix($rows, $cols);
}

// Функція для генерації випадкових значень для матриці
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
?>

<!DOCTYPE html>
<html lang="uk">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Matrix Calculator</title>
	<link rel="stylesheet" href="styles.css">
</head>

<body>
	<div class="container">
		<h1>Matrix Calculator</h1>

		<!-- Форма для введення розмірності матриць та вибору операції -->
		<form action="index.php" method="post">
			<label for="rows">Кількість рядків:</label>
			<input type="number" id="rows" name="rows" min="1" max="10" value="<?php echo $rows; ?>" required>

			<label for="cols">Кількість стовпців:</label>
			<input type="number" id="cols" name="cols" min="1" max="10" value="<?php echo $cols; ?>" required>

			<button type="submit">Згенерувати матриці</button>
		</form>

		<!-- Форма для введення значень матриць -->
		<form action="process.php" method="post">
			<?php if ($matrixA !== null && $matrixB !== null): ?>
				<div class="matrices">
					<h3>Матриця A</h3>
					<table>
						<tbody>
							<?php foreach ($matrixA as $i => $row): ?>
								<tr>
									<?php foreach ($row as $j => $cell): ?>
										<td><input type="number" name="matrixA[<?php echo $i; ?>][<?php echo $j; ?>]" value="<?php echo $cell; ?>" required></td>
									<?php endforeach; ?>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>

					<h3>Матриця B</h3>
					<table>
						<tbody>
							<?php foreach ($matrixB as $i => $row): ?>
								<tr>
									<?php foreach ($row as $j => $cell): ?>
										<td><input type="number" name="matrixB[<?php echo $i; ?>][<?php echo $j; ?>]" value="<?php echo $cell; ?>" required></td>
									<?php endforeach; ?>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>

					<label for="operation">Операція:</label>
					<select id="operation" name="operation" required>
						<option value="add">Додавання</option>
						<option value="subtract">Віднімання</option>
						<option value="multiply">Множення</option>
						<option value="transpose">Транспонування</option>
					</select>

					<button type="submit">Обчислити</button>
				</div>
			<?php endif; ?>
		</form>

		<!-- Виведення результату -->
		<?php if ($result !== null): ?>
			<h3>Результат обчислення:</h3>
			<table class="result-table">
				<tbody>
					<?php foreach ($result as $row): ?>
						<tr>
							<?php foreach ($row as $cell): ?>
								<td><?php echo htmlspecialchars($cell); ?></td>
							<?php endforeach; ?>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		<?php endif; ?>

		<!-- Виведення помилки -->
		<?php if ($error !== null): ?>
			<div class="error-message">
				<p><?php echo htmlspecialchars($error); ?></p>
			</div>
		<?php endif; ?>

		<!-- Кнопка очищення -->
		<form action="index.php" method="get">
			<button type="submit">Очистити</button>
		</form>
	</div>
</body>

</html>