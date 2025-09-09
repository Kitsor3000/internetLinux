export function fileSize(size: number) {
  const i = Math.floor(Math.log(size) / Math.log(1024));
  return (
    Number((size / Math.pow(1024, i)).toFixed(2)) +
    ' ' +
    ['B', 'kB', 'MB', 'GB', 'TB'][i]
  );
}

export function dayOfWeekMap(): Array<string> {
  return [
    'sunday',
    'monday',
    'tuesday',
    'wednesday',
    'thursday',
    'friday',
    'saturday',
  ]
}

export function dayOfWeek(day: number): string {
  return dayOfWeekMap()[day];
}



export function dayOfWeekOptionsList(): Array<{label: string, value: string}> {
  return dayOfWeekMap().map(
      (day, index): {label:string, value:string} => {
        return {
          label: day,
          value: `${index}`
        };
      }
    )
  ;
}

export function scheduleTypes(): Array<string> {
  return [
    'training',
    'game',
  ]
}

export function scheduleType(type: any): string {
  return scheduleTypes()[type];
}

export function typeOptionsList(): Array<{label: string, value: string}> {
  return scheduleTypes().map(
      (type, index): {label:string, value:string} => {
        return {
          label: type,
          value: `${index}`
        };
      }
  )
}

export function gamePeriodStatuses(): Array<string> {
  return [
    'DRAFT',
    'PLANNED',
    'PLAYING',
    'FINISHED',
  ]
}


export function gamePeriodStatusOptionsList(): Array<{label: string, value: string}> {
  return gamePeriodStatuses().map(
      (status, index): {label:string, value:string} => {
        return {
          label: status,
          value: `${status}`
        };
      }
  )
}
