import React from 'react';
import ReactDatePicker from 'react-datepicker';
import 'react-datepicker/dist/react-datepicker.css';
import { Omit } from 'lodash';

interface DateInputProps extends Omit<React.ComponentProps<typeof ReactDatePicker>, 'onChange' | 'value'> {
  label?: string;
  name?: string;
  error?: string;
  value: Date | null;
  onChange: (date: Date | null) => void;
}

export default function DateInput({
  name,
  error,
  value,
  onChange,
  className,
  ...props
}: DateInputProps) {
  return (
      <ReactDatePicker
        id={name}
        name={name}
        selected={value}
        onChange={onChange}
        dateFormat="yyyy-MM-dd"
        wrapperClassName={'w-full'}
        className={`form-input w-full focus:outline-none focus:ring-1 focus:ring-indigo-400 focus:border-indigo-400 border-gray-300 rounded ${
          error ? 'border-red-400 focus:border-red-400 focus:ring-red-400' : ''
        } ${className}`}
        {...props}
      />
  );
}
