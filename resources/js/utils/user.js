const user = window?.user;

export const USER_UUID = user?.uuid ?? null;
export const USER_FULL_NAME = user?.name ?? null;
export const USER_EMAIL = user?.email ?? null;
