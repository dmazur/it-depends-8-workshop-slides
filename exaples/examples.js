class Order {
    construct() {
        this.status = '';
    }

    setStatus(status) {
        this.status = status;
    }
}

Order.STATUS_PROCESSING = 'processing';

class ProcessedOrderFilter {
    run(orders) {
        return orders.filter(order => order.status !== Order.STATUS_PROCESSING);
    }
}

class OrderProcessor {
    constructor()
    {
        this.orderList = [];
    }
    // (MANY MANY LOC)

    filterUniqueAndProcessed(orders) {
        return orders.filter(order => order.status !== Order.STATUS_PROCESSING);
    }

    addToProcessing(orders) {
        for (const order of orders) {
            order.setStatus(Order.STATUS_PROCESSING);
            this.orderList.push(order);
        }
    }

    addOrders(orders) {
        const filter = new ProcessedOrderFilter();
        const filteredOrders = filter.run(orders);

        this.addToProcessing(filteredOrders);
    }
    // (MANY MANY LOC)
}

let testMe = {
    addOrders() {
        // many many LOC

        if (...) {
            for (const order of orders) {
                order.setStatus(Order.STATUS_PROCESSING);
            }
        }

        // many many LOC
    }
};

const order1 = new Order();
const order2 = new Order();
const order3 = new Order();
order3.status = Order.STATUS_PROCESSING;

const process = new OrderProcessor();
process.addOrders([order1, order2, order3]);

console.table(process.orderList);
