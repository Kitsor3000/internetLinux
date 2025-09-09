import React, {ComponentProps, useRef} from 'react';
import {Omit} from "lodash";
import {useForm} from "@inertiajs/react";

interface CheckboxInputProps extends Omit<ComponentProps<'input'>, 'onChange'>{
  label?: string;
  onChange?: (value: boolean) => void;
}

export function CheckboxInput({ label, name, value, onChange, ...props }: CheckboxInputProps) {
  const {data, setData} = useForm({
    checked: value,
  });
  function handleChange(e: React.FormEvent<HTMLInputElement>) {
    const value = e.currentTarget?.checked || false;

    setData('checked', value);
    onChange?.(value);
  }

  return (
    <label className="flex items-center select-none" htmlFor={name}>
      <input
        id={name}
        name={name}
        type="checkbox"
        className="mr-2 form-checkbox rounded text-indigo-600 focus:ring-indigo-600"
        onChange={handleChange}
        checked={data.checked}
        {...props}
      />
      <span className="text-sm">{label}</span>
    </label>
  );
}
