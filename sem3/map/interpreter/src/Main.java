import controller.Controller;
import controller.IController;
import domain.expression.ArithmeticExpression;
import domain.expression.ValueExpression;
import domain.expression.VariableExpression;
import domain.operator.ArithmeticOperator;
import domain.state.ProgramState;
import domain.statement.*;
import domain.statement.control.CompoundStatement;
import domain.statement.print.PrintStatement;
import domain.statement.variable.VariableAssignmentStatement;
import domain.statement.variable.VariableDeclarationStatement;
import domain.type.IntegerType;
import domain.value.IntegerValue;
import repository.IRepository;
import repository.Repository;
import view.text.TextMenu;
import view.text.command.ExitCommand;
import view.text.command.RunExampleCommand;

public class Main {

    public static void main(String[] args) {
        IStatement ex1 = new CompoundStatement(
            new CompoundStatement(
                new VariableDeclarationStatement("a", new IntegerType()),
                new VariableDeclarationStatement("b", new IntegerType())
            ),
            new PrintStatement(new VariableExpression("a"))
        );

        IStatement ex2 = new CompoundStatement(
            new VariableDeclarationStatement("a", new IntegerType()),
            new CompoundStatement(
                new VariableDeclarationStatement("b", new IntegerType()),
                new CompoundStatement(
                    new VariableAssignmentStatement(
                        "a",
                        new ArithmeticExpression(
                            new ValueExpression(new IntegerValue(2)),
                            new ArithmeticExpression(
                                new ValueExpression(new IntegerValue(3)),
                                new ValueExpression(new IntegerValue(5)),
                                ArithmeticOperator.STAR),
                            ArithmeticOperator.PLUS)),
                    new CompoundStatement(
                        new VariableAssignmentStatement(
                            "b",
                            new ArithmeticExpression(
                                    new VariableExpression("a"),
                                    new ValueExpression(new IntegerValue(1)),
                                    ArithmeticOperator.PLUS)),
                        new PrintStatement(new VariableExpression("b"))
                    ))
            )
        );

        ProgramState pr1 = new ProgramState(ex1);
        ProgramState pr2 = new ProgramState(ex2);

        IRepository repo1 = new Repository(pr1, "log1.txt");
        IRepository repo2 = new Repository(pr2, "log2.txt");

        IController ctrl1 = new Controller(repo1, false);
        IController ctrl2 = new Controller(repo2, false);

        TextMenu menu = new TextMenu();
        menu.addCommand(new ExitCommand("0", "exit"));
        menu.addCommand(new RunExampleCommand("1", ex1.toString(), ctrl1));
        menu.addCommand(new RunExampleCommand("2", ex2.toString(), ctrl2));
        menu.show();
    }
}