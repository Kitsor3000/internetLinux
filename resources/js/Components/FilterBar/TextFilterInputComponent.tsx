import React from 'react';

export default function TextFilterInput({ name, value, onChange, placeholder = '' }) {
  return (
    <input
      type="text"
      name={name}
      value={value}
      placeholder={placeholder}
      onChange={e => onChange(e.target.value)}
      className="form-input w-full border rounded px-2 py-1"
    />
  );
}