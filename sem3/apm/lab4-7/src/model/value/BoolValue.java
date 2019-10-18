package model.value;

import model.type.BoolType;
import model.type.Type;

public class BoolValue implements Value<Boolean> {
    private boolean value;

    public BoolValue(boolean value) {
        this.value = value;
    }

    @Override
    public Boolean getValue() {
        return this.value;
    }

    @Override
    public String toString() {
        return String.valueOf(this.value);
    }

    @Override
    public Type getType() {
        return new BoolType();
    }
}