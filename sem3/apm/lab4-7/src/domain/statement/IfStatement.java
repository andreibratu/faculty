package domain.statement;

import adt.IDictionary;
import adt.IStack;
import domain.expression.Expression;
import domain.state.ProgramState;
import domain.type.IllegalTypeException;
import domain.value.Value;

public class IfStatement implements IStatement {
    private Expression expression;
    private IStatement thenStatement;
    private IStatement elseStatement;

    IfStatement(Expression expression, IStatement thenStatement, IStatement elseStatement) {
        this.expression = expression;
        this.thenStatement = thenStatement;
        this.elseStatement = elseStatement;
    }

    public String toString() {
        return "IF (" + expression.toString() + ") " +
                "THEN ( " + thenStatement.toString() + " ) " +
                "ELSE ( " + elseStatement.toString() + ")";
    }

    @Override
    public ProgramState execute(ProgramState state) throws Exception {
        IStack<IStatement> exeStack = state.getExecutionStack();
        IDictionary<String, Value> symTable = state.getSymbolTable();
        Value result = this.expression.evaluate(symTable);
        if(!result.getValue().equals(0))
            exeStack.push(thenStatement);
        else
            exeStack.push(elseStatement);
        return state;
    }

    @Override
    public IStatement deepCopy() {
        return new IfStatement(expression.deepCopy(), thenStatement.deepCopy(), elseStatement.deepCopy());
    }
}