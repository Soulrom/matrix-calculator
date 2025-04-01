# Matrix Calculator

Matrix Calculator is a simple web application designed to perform various matrix operations. Users can add, subtract, multiply matrices, and transpose them. The application supports both manual matrix input and automatic random matrix generation.

## Features

- **Matrix Addition**: Add two matrices of the same dimensions.
- **Matrix Subtraction**: Subtract one matrix from another.
- **Matrix Multiplication**: Multiply two matrices if their dimensions are compatible.
- **Matrix Transposition**: Transpose a given matrix.

## Technologies Used

- **PHP**: Backend logic for matrix operations.
- **HTML**: Structure and layout of the web interface.
- **CSS**: Styling for a user-friendly interface.

## Getting Started

Follow these steps to set up and run the project locally:

### Prerequisites

- A local server environment such as **XAMPP** or **MAMP**.

### Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/yourusername/matrix-calculator.git
   ```

2. Set up the local server:
   - Download and install [XAMPP](https://www.apachefriends.org/) or [MAMP](https://www.mamp.info/).
   - Move the project folder to the server's web directory (e.g., `htdocs` in XAMPP).

3. Open the project in your browser:
   ```
   http://localhost/matrix-calculator/
   ```

## Usage

1. **Select Matrix Dimensions**: Choose the number of rows and columns for the matrices.
2. **Input Matrices**: Either manually input matrix values or generate random matrices.
3. **Choose an Operation**:
   - Addition
   - Subtraction
   - Multiplication
   - Transposition
4. **Calculate**: Click the "Calculate" button to view the result.

### Example

#### Input Matrices:

Matrix A:
```
[1, 2, 3]
[4, 5, 6]
[7, 8, 9]
```

Matrix B:
```
[9, 8, 7]
[6, 5, 4]
[3, 2, 1]
```

#### Operation:
Addition

#### Result:
```
[10, 10, 10]
[10, 10, 10]
[10, 10, 10]
```

## Project Structure

```
/matrix-calculator
|-- index.php            # Main page with forms for input and operations
|-- process.php          # Handles requests and matrix operations
|-- MatrixCalculator.php # Class for performing matrix calculations
|-- styles.css           # Styles for the user interface
|-- README.md            # Project documentation
```

## License

This project is licensed under the [MIT License](LICENSE).

## Contributing

Contributions are welcome! Feel free to fork the repository and submit a pull request.

## Contact

For any inquiries or feedback, please contact [your-email@example.com].
