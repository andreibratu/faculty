package model.expression;

import model.operator.LogicalOperator;
import model.type.BoolType;
import model.type.IllegalTypeException;
import model.type.IntegerType;
import model.type.Type;
import model.value.BoolValue;
import model.value.IntegerValue;
import model.value.Value;
import java.util.HashMap;

public class LogicalExpression implements Expression {
    Expression first;
    Expression second;
    LogicalOperator operator;

    @Override
    public Value evaluate(HashMap<String, Value> table) throws Exception
    {
        Value v1 = first.evaluate(table);
        Value v2 = second.evaluate(table);
        Type type1 = v1.getType();
        Type type2 = v2.getType();
        boolean result = false;
        switch (this.operator)
        {
            case EQUAL:
            case DIFFERENT:
                if (!v1.getType().equals(v2.getType()))
                    throw new IllegalTypeException(v1.getType(), v2.getType());
                break;
            case GT:
            case GTE:
            case ST:
            case STE:
                if (!type1.equals(new IntegerType()))
                    throw new IllegalTypeException(new IntegerType(), type1);
                if (!type2.equals(new IntegerType()))
                    throw new IllegalTypeException(new IntegerType(), type2);
                break;
            case AND:
            case OR:
                if (!type1.equals(new BoolType()))
                    throw new IllegalTypeException(new BoolType(), type1);
                if (!type2.equals(new BoolType()))
                    throw new IllegalTypeException(new BoolType(), type2);
                break;
        }
        switch (this.operator)
        {
            case EQUAL:
                result = v1.getValue().equals(v2.getValue());
                break;
            case DIFFERENT:
                result = !v1.getValue().equals(v2.getValue());
                break;
            case GT:
                result = ((IntegerValue)v1).getValue() > ((IntegerValue)v2).getValue();
                break;
            case GTE:
                result = ((IntegerValue)v1).getValue() >= ((IntegerValue)v2).getValue();
                break;
            case ST:
                result = ((IntegerValue)v1).getValue() < ((IntegerValue)v2).getValue();
                break;
            case STE:
                result = ((IntegerValue)v1).getValue() <= ((IntegerValue)v2).getValue();
                break;
            case AND:
                result = ((BoolValue)v1).getValue() && ((BoolValue)v2).getValue();
                break;
            case OR:
                result = ((BoolValue)v1).getValue() || ((BoolValue)v2).getValue();
                break;
        }
        return new BoolValue(result);
    }
}
