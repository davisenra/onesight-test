/**
 *
 * @param {string} path
 * @param {RequestInit} options
 * @returns {Promise<Response>}
 */
export async function useApiFetch(path, options = undefined) {
    const headers = {
        Accept: 'application/json',
        'Content-Type': 'application/json',
        Referer: import.meta.env.VITE_APP_DOMAIN
    };

    return fetch(`${import.meta.env.VITE_APP_BASE}${path}`, {
        credentials: 'include',
        ...options,
        headers: {
            ...headers,
            ...options?.headers
        }
    });
}
